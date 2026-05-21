import json

logs_path = r"C:\Users\Asylzat\.gemini\antigravity\brain\ea5dacf7-4f67-4b40-aa32-3e3be9b4264b\.system_generated\logs\transcript.jsonl"

with open(logs_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

print(f"Total lines: {len(lines)}")

user_inputs = []
for i, line in enumerate(lines):
    try:
        data = json.loads(line)
        if data.get("type") == "USER_INPUT" or data.get("source") == "USER_EXPLICIT":
            content = data.get("content", "")
            if content:
                user_inputs.append((i, content))
    except Exception as e:
        pass

print(f"Found {len(user_inputs)} user inputs.")
with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\all_user_inputs.txt", "w", encoding="utf-8") as f_out:
    for idx, text in user_inputs:
        f_out.write(f"--- USER INPUT {idx} ---\n")
        f_out.write(text)
        f_out.write("\n\n")

print("Saved all user inputs to all_user_inputs.txt")
