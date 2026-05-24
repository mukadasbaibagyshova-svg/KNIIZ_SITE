import json

logs_path = r"C:\Users\Asylzat\.gemini\antigravity\brain\0f7c926e-614d-4f15-9706-d733442924b5\.system_generated\logs\transcript.jsonl"

with open(logs_path, 'r', encoding='utf-8') as f:
    for i, line in enumerate(f):
        try:
            data = json.loads(line)
            if data.get("type") == "USER_INPUT":
                content = data.get("content", "")
                print(f"Step {data.get('step_index')}: USER_INPUT of length {len(content)}")
                # Check for keywords
                for kw in ["ячменя", "пшеницы", "кукурузы", "свеклы"]:
                    if kw in content:
                        print(f"  -> Contains keyword '{kw}'")
        except Exception as e:
            pass
