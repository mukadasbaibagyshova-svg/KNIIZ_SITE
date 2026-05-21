import os
import json

appdata_dir = r"C:\Users\Asylzat\.gemini\antigravity"
keywords = ["Иманалиев Бакытбек", "Бестам", "Ватан", "Владлен", "Кылым", "Максат"]

found_chunks = []

for root, dirs, files in os.walk(appdata_dir):
    for file in files:
        if file.endswith((".jsonl", ".json", ".txt", ".log")):
            path = os.path.join(root, file)
            try:
                # read file
                with open(path, "r", encoding="utf-8", errors="ignore") as f:
                    content = f.read()
                # Check for keywords
                for kw in keywords:
                    if kw in content:
                        print(f"Found keyword '{kw}' in {path}")
                        # Let's save the file path and search context
                        idx = content.find(kw)
                        start = max(0, idx - 1000)
                        end = min(len(content), idx + 10000)
                        found_chunks.append(f"=== PATH: {path} ===\n{content[start:end]}\n\n")
                        break
            except Exception as e:
                pass

with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\scanned_appdata_logs.txt", "w", encoding="utf-8") as f_out:
    f_out.write("\n\n".join(found_chunks))

print(f"Done scanning. Found {len(found_chunks)} chunks.")
