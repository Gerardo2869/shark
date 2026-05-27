import os
import glob

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

css_to_add = """
        [data-theme="dark"] {
            --bg-color: #000000;
            --text-color: #f5f5f7;
            --text-muted: #a1a1a6;
            --card-bg: #1c1c1e;
            --border-color: #38383a;
            --input-bg: #2c2c2e;
            --primary-color: #0a84ff;
            --primary-hover: #409cff;
        }"""

js_to_add = """
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const htmlElement = document.documentElement;
            const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            
            function setTheme(theme) {
                htmlElement.setAttribute('data-theme', theme);
                localStorage.setItem('theme', theme);
                
                const sunIcon = document.getElementById('sunIcon');
                const moonIcon = document.getElementById('moonIcon');
                
                if (sunIcon && moonIcon) {
                    if (theme === 'dark') {
                        sunIcon.style.display = 'none';
                        moonIcon.style.display = 'block';
                    } else {
                        sunIcon.style.display = 'block';
                        moonIcon.style.display = 'none';
                    }
                }
            }
            
            setTheme(savedTheme);
            
            // Allow toggle clicks from a button
            window.toggleTheme = function() {
                const currentTheme = htmlElement.getAttribute('data-theme');
                setTheme(currentTheme === 'dark' ? 'light' : 'dark');
            };
        });
    </script>
"""

button_css = """
        .theme-toggle-admin {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-color);
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }
        .theme-toggle-admin:hover {
            background-color: rgba(128, 128, 128, 0.1);
        }
"""

for fpath in files:
    if not os.path.exists(fpath):
        print(f"Skipping {fpath}, not found.")
        continue
    
    with open(fpath, "r") as f:
        content = f.read()

    # 1. Inject CSS [data-theme="dark"] after :root { ... }
    if "[data-theme=\"dark\"]" not in content and ":root {" in content:
        # Find the end of the :root block
        root_start = content.find(":root {")
        root_end = content.find("}", root_start)
        
        # Insert css_to_add and button_css after root_end
        part1 = content[:root_end+1]
        part2 = content[root_end+1:]
        content = part1 + "\n" + css_to_add + "\n" + button_css + part2

    # 2. Add transition to body
    if "transition: background-color 0.5s ease" not in content and "body {" in content:
        body_start = content.find("body {")
        content = content[:body_start+6] + "\n            transition: background-color 0.5s ease, color 0.5s ease;" + content[body_start+6:]

    # 3. Inject JS before </body>
    if "function setTheme(theme)" not in content and "</body>" in content:
        content = content.replace("</body>", js_to_add + "\n</body>")

    with open(fpath, "w") as f:
        f.write(content)
    
    print(f"Processed {fpath}")

