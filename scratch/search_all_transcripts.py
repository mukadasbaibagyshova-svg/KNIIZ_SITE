import os
import json

brain_dir = r"C:\Users\Asylzat\.gemini\antigravity\brain"
matches = []

for root, dirs, files in os.walk(brain_dir):
    if "transcript.jsonl" in files:
        path = os.path.join(root, "transcript.jsonl")
        try:
            with open(path, "r", encoding="utf-8") as f:
                for line in f:
                    if "Отдел селекции и первичного семеноводства ячменя" in line:
                        try:
                            data = json.loads(line)
                            if data.get("type") == "USER_INPUT":
                                content = data.get("content", "")
                                if "Отдел селекции и первичного семеноводства ячменя" in content:
                                    matches.append((path, content))
                                    print(f"FOUND matching USER_INPUT in {path} of length {len(content)}")
                        except Exception as e:
                            pass
        except Exception as e:
            pass

print(f"\nTotal matches found: {len(matches)}")
if matches:
    longest = max(matches, key=lambda x: len(x[1]))
    print(f"Longest match in {longest[0]} (length: {len(longest[1])})")
    out_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\questionnaire_found.txt"
    with open(out_path, "w", encoding="utf-8") as out:
        out.write(longest[1])
    print(f"Wrote match to {out_path}")
else:
    print("No USER_INPUT matches found.")
