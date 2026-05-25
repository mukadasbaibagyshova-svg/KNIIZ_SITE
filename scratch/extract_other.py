import json
import os

other_transcript = r"C:\Users\Asylzat\.gemini\antigravity\brain\a5cfd127-f099-4563-81c6-89aaad77f44e\.system_generated\logs\transcript.jsonl"
output_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\other_transcript_content.txt"

if os.path.exists(other_transcript):
    with open(other_transcript, "r", encoding="utf-8") as f:
        for idx, line in enumerate(f):
            try:
                data = json.loads(line)
                content = data.get("content", "")
                if "ЖАЗДЫК АРПА" in content or "ЯРОВОЙ ЯЧМЕНЬ" in content:
                    print(f"Found match on line {idx}, content len {len(content)}")
                    with open(output_path, "w", encoding="utf-8") as out:
                        out.write(content)
                    print(f"Wrote to {output_path}")
            except Exception as e:
                print(f"Error parsing line {idx}: {e}")
else:
    print("Other transcript path does not exist.")
