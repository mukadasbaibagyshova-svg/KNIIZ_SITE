import json
import os

transcript_path = r"C:\Users\Asylzat\.gemini\antigravity\brain\6c8de90d-9889-47b4-9808-61f31b5e02f5\.system_generated\logs\transcript.jsonl"
output_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\full_request_current.txt"

if os.path.exists(transcript_path):
    with open(transcript_path, "r", encoding="utf-8") as f:
        first_line = f.readline()
        try:
            data = json.loads(first_line)
            content = data.get("content", "")
            with open(output_path, "w", encoding="utf-8") as out:
                out.write(content)
            print("Successfully extracted and wrote content.")
        except Exception as e:
            print("Error parsing JSON:", e)
else:
    print("Transcript path does not exist.")
