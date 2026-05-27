import os

files = [
    "resources/views/admin/audit/index.blade.php",
    "resources/views/bundles/index.blade.php",
    "resources/views/bundles/create.blade.php",
    "resources/views/quotes/create.blade.php",
    "resources/views/quotes/edit.blade.php",
    "resources/views/sales/create.blade.php",
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

    if "window.toggleTheme()" in content:
        continue # Already added

    # If there is <div class="header">
    if "class=\"header\"" in content:
        # Find the first </div> that closes the header OR just put it before the first <a href ...>
        # A simpler way: we can just find the end of the <div class="header"> block, but that's hard with regex.
        # Let's insert it right after the <h1> element in the header.
        h1_idx = content.find("</h1>")
        if h1_idx != -1:
            content = content[:h1_idx+5] + toggle_btn + content[h1_idx+5:]
    
    with open(fpath, "w") as f:
        f.write(content)

print("Done remaining buttons.")
