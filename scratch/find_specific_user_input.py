import json

logs_path = r"C:\Users\Asylzat\.gemini\antigravity\brain\ea5dacf7-4f67-4b40-aa32-3e3be9b4264b\.system_generated\logs\transcript.jsonl"

with open(logs_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

for i, line in enumerate(lines):
    if "прям мне нравится главная страница" in line:
        print(f"Found on line {i}")
        data = json.loads(line)
        content = data.get("content", "")
        with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\questionnaire_full.txt", "w", encoding="utf-8") as f_out:
            f_out.write(content)
        print(f"Successfully wrote {len(content)} chars of step index {i} to questionnaire_full.txt")
        break
else:
    print("Not found")
