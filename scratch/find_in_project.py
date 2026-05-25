import os

project_dir = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE"
results = []

for root, dirs, files in os.walk(project_dir):
    if "scratch" in root or ".git" in root:
        continue
    for file in files:
        path = os.path.join(root, file)
        try:
            with open(path, "r", encoding="utf-8") as f:
                content = f.read()
                if "ЖАЗДЫК АРПА" in content or "НАРЫН 27" in content:
                    print(f"Found in project file: {path}, size: {len(content)} chars")
                    results.append(path)
        except Exception as e:
            # try with another encoding if utf-8 fails
            try:
                with open(path, "r", encoding="windows-1251") as f:
                    content = f.read()
                    if "ЖАЗДЫК АРПА" in content or "НАРЫН 27" in content:
                        print(f"Found in project file: {path} (cp1251), size: {len(content)} chars")
                        results.append(path)
            except Exception as e2:
                pass

print(f"Project search complete. Found in {len(results)} files.")
