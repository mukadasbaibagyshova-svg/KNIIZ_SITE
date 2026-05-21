import json

logs_path = r"C:\Users\Asylzat\.gemini\antigravity\brain\ea5dacf7-4f67-4b40-aa32-3e3be9b4264b\.system_generated\logs\transcript.jsonl"

with open(logs_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

print(f"Total lines: {len(lines)}")

type_counts = {}
for i, line in enumerate(lines):
    try:
        data = json.loads(line)
        t_type = data.get("type", "none")
        type_counts[t_type] = type_counts.get(t_type, 0) + 1
        
        # Print info about USER_INPUT or USER_EXPLICIT
        if "user" in t_type.lower() or data.get("source") == "USER_EXPLICIT":
            print(f"Index {i} | Type: {t_type} | Source: {data.get('source')} | Len: {len(data.get('content', ''))}")
    except Exception as e:
        pass

print("Type counts:", type_counts)
