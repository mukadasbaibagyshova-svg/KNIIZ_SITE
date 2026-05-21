import os

root_dir = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE"
for filename in os.listdir(root_dir):
    if filename.endswith(".php"):
        filepath = os.path.join(root_dir, filename)
        with open(filepath, "r", encoding="utf-8", errors="ignore") as f:
            content = f.read()
            if "include 'header.php'" in content or 'include "header.php"' in content:
                print(f"{filename} includes root header.php")
            if "include 'includes/header.php'" in content or 'include "includes/header.php"' in content:
                print(f"{filename} includes includes/header.php")
