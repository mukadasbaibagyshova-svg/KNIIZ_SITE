import os
import json

appdata_dir = r"C:\Users\Asylzat\.gemini\antigravity"
results = []

for root, dirs, files in os.walk(appdata_dir):
    for file in files:
        if file.endswith((".jsonl", ".txt", ".log")):
            path = os.path.join(root, file)
            try:
                # read file in binary mode to avoid encoding issues and scan quickly
                with open(path, "rb") as f:
                    content = f.read()
                    target_ky = "ЖАЗДЫК АРПА".encode("utf-8")
                    target_ru = "ЯРОВОЙ ЯЧМЕНЬ".encode("utf-8")
                    if target_ky in content or target_ru in content:
                        print(f"Found in: {path}, size: {len(content)} bytes")
                        results.append(path)
            except Exception as e:
                pass

print(f"Done. Found in {len(results)} files.")
