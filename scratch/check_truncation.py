import json

logs_path = r"C:\Users\Asylzat\.gemini\antigravity\brain\ea5dacf7-4f67-4b40-aa32-3e3be9b4264b\.system_generated\logs\transcript.jsonl"

with open(logs_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

for i, line in enumerate(lines):
    if "прям мне нравится главная страница" in line:
        print(f"Line {i} raw length: {len(line)}")
        if "truncated" in line:
            print("The raw line contains the word 'truncated'.")
        else:
            print("The raw line does not contain 'truncated' - it has the full text!")
        break
