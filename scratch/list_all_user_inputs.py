import os
import json

brain_dir = r"C:\Users\Asylzat\.gemini\antigravity\brain"

for root, dirs, files in os.walk(brain_dir):
    if "transcript.jsonl" in files:
        path = os.path.join(root, "transcript.jsonl")
        print(f"File: {path}")
        try:
            with open(path, "r", encoding="utf-8") as f:
                for i, line in enumerate(f):
                    try:
                        data = json.loads(line)
                        if data.get("type") == "USER_INPUT":
                            content = data.get("content", "")
                            print(f"  Step {data.get('step_index')}: USER_INPUT of length {len(content)}")
                            if "Отдел селекции" in content:
                                print(f"    -> Contains 'Отдел селекции'")
                    except Exception as e:
                        pass
        except Exception as e:
            print(f"  Error reading file: {e}")
