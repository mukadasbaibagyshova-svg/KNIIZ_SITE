import json

logs_path = r"C:\Users\Asylzat\.gemini\antigravity\brain\ea5dacf7-4f67-4b40-aa32-3e3be9b4264b\.system_generated\logs\transcript.jsonl"

with open(logs_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

print(f"Total lines: {len(lines)}")

long_entries = []
for i, line in enumerate(lines):
    try:
        data = json.loads(line)
        content = data.get("content", "")
        # Also check tool_calls or others
        if not content and "tool_calls" in data:
            content = str(data["tool_calls"])
        
        if len(content) > 1000:
            long_entries.append((i, data.get("type"), data.get("source"), len(content), content[:150]))
    except Exception as e:
         pass

print(f"Found {len(long_entries)} long entries.")
for idx, t_type, source, length, snippet in long_entries:
    print(f"Line {idx} | Type: {t_type} | Source: {source} | Length: {length} | Snippet: {snippet}...")
