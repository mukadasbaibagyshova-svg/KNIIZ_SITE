import os
import json

transcript_path = r"C:\Users\Asylzat\.gemini\antigravity\brain\0f7c926e-614d-4f15-9706-d733442924b5\.system_generated\logs\transcript.jsonl"

if os.path.exists(transcript_path):
    print("Transcript exists. Checking all lines...")
    with open(transcript_path, "r", encoding="utf-8") as f:
        for idx, line in enumerate(f):
            try:
                data = json.loads(line)
                t_type = data.get("type")
                source = data.get("source")
                content = data.get("content", "")
                
                # Check if it has the Barley section
                has_barley = "Отдел селекции и первичного семеноводства ячменя" in content
                
                print(f"Line {idx} | Type: {t_type} | Source: {source} | Has barley: {has_barley} | Len: {len(content)}")
                
                if has_barley and t_type == "USER_INPUT":
                    print(f"--- MATCH AT LINE {idx} ---")
                    # Let's save this content specifically to a separate file
                    out_path = rf"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\user_input_{idx}.txt"
                    with open(out_path, "w", encoding="utf-8") as out:
                        out.write(content)
                    print(f"Wrote to {out_path}")
            except Exception as e:
                print(f"Error at line {idx}: {e}")
else:
    print("Transcript does not exist.")
