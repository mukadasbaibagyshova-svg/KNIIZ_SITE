import os

search_dir = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE"
keywords = ["Изилдөөлөрдүн", "Түшүмдүүлүк", "Нарын 27", "Иманалиев", "Аккулаков"]

found_files = {}

for root, dirs, files in os.walk(search_dir):
    if ".git" in root:
        continue
    for file in files:
        if file.endswith((".py", ".txt", ".json", ".php", ".md", ".css")):
            path = os.path.join(root, file)
            try:
                with open(path, "r", encoding="utf-8") as f:
                    content = f.read()
                for kw in keywords:
                    if kw.lower() in content.lower():
                        if path not in found_files:
                            found_files[path] = []
                        found_files[path].append(kw)
            except Exception as e:
                pass

with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\find_in_files_results.txt", "w", encoding="utf-8") as f_out:
    f_out.write(f"Found matches in {len(found_files)} files:\n")
    for path, kws in found_files.items():
        f_out.write(f"{path}: {kws}\n")

print(f"Results written to find_in_files_results.txt")
