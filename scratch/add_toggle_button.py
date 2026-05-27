import os
import re

files = [
    "resources/views/admin/dashboard.blade.php",
    "resources/views/admin/audit/index.blade.php",
    "resources/views/figures/index.blade.php",
    "resources/views/paints/index.blade.php",
    "resources/views/bundles/index.blade.php",
    "resources/views/bundles/create.blade.php",
    "resources/views/quotes/index.blade.php",
    "resources/views/quotes/create.blade.php",
    "resources/views/quotes/edit.blade.php",
    "resources/views/sales/index.blade.php",
    "resources/views/sales/create.blade.php",
    "resources/views/users/index.blade.php",
    "resources/views/profile/edit.blade.php"
]

toggle_btn = """
            <button type="button" class="theme-toggle-admin" onclick="window.toggleTheme()" aria-label="Cambiar tema">
                <svg id="sunIcon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="5"></circle>
                    <line x1="12" y1="1" x2="12" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="23"></line>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                    <line x1="1" y1="12" x2="3" y2="12"></line>
                    <line x1="21" y1="12" x2="23" y2="12"></line>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                </svg>
                <svg id="moonIcon" style="display:none;" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
            </button>
"""

for fpath in files:
    if not os.path.exists(fpath):
        continue
        
    with open(fpath, "r") as f:
        content = f.read()

    if "onclick=\"window.toggleTheme()\"" in content:
        continue # already added

    # dashboard case
    if fpath == "resources/views/admin/dashboard.blade.php":
        # Make the header a flexbox to put the button on the right
        old_header = "<header>"
        new_header = "<header style=\"display:flex; justify-content:space-between; align-items:center;\">"
        content = content.replace(old_header, new_header)
        
        # Insert button before closing header
        content = content.replace("</header>", f"    {toggle_btn}\n        </header>")

    # other cases where there's <div class="header">
    elif "class=\"header\"" in content:
        # Many pages have <div class="header"> with two flex children.
        # Find the second <div style="display: flex; align-items: center; gap: 12px;"> or similar.
        # Let's just find the form tag for logout inside the header block and insert the button right before the form.
        if "<form action=\"{{ route('logout') }}\"" in content:
            logout_form_idx = content.find("<form action=\"{{ route('logout') }}\"")
            if logout_form_idx != -1:
                content = content[:logout_form_idx] + toggle_btn + "\n                " + content[logout_form_idx:]
        else:
            # Profile edit case: maybe it doesn't have a logout button in header.
            # Just insert before </div> of header
            # It's a bit naive.
            if "class=\"header\"" in content:
                header_start = content.find("class=\"header\"")
                header_end = content.find("</div>", header_start)
                # To make sure we are at the end of the main header block, we might need a better regex.
                # Actually, all admin pages have standard header blocks now since they were copied.
                print(f"Check {fpath} manually if logout form wasn't found")
    
    with open(fpath, "w") as f:
        f.write(content)

print("Done toggle buttons.")
