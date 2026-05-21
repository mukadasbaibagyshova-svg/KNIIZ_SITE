import os

search_dir = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE"
keywords = ["live", "lıve", "ливе"]

for root, dirs, files in os.walk(search_dir):
    if ".git" in root or "scratch" in root:
        continue
    for file in files:
        if file.endswith((".php", ".css", ".js", ".json")):
            path = os.path.join(root, file)
            try:
                with open(path, "r", encoding="utf-8") as f:
                    lines = f.readlines()
                    for idx, line in enumerate(lines):
                        for kw in keywords:
                            if kw in line.lower():
                                print(f"Found '{kw}' in {path} on line {idx+1}: {line.strip()}")
            except Exception as e:
                pass
