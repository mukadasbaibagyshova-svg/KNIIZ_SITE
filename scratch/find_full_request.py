import os
import json

brain_dir = r"C:\Users\Asylzat\.gemini\antigravity\brain"
current_conv = "0f7c926e-614d-4f15-9706-d733442924b5"

# Let's list all files in current conversation logs
log_dir = os.path.join(brain_dir, current_conv, ".system_generated", "logs")
transcript_path = os.path.join(log_dir, "transcript.jsonl")

print(f"Checking transcript path: {transcript_path}")
if os.path.exists(transcript_path):
    print("Transcript exists. Scanning for USER_INPUT...")
    with open(transcript_path, "r", encoding="utf-8") as f:
        for line in f:
            try:
                data = json.loads(line)
                if data.get("type") == "USER_INPUT":
                    content = data.get("content", "")
                    if "Отдел селекции и первичного семеноводства ячменя" in content:
                        print(f"Found matching USER_INPUT of length {len(content)}")
                        # Write it to a file
                        output_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\untruncated_request.txt"
                        with open(output_path, "w", encoding="utf-8") as out:
                            out.write(content)
                        print(f"Successfully wrote full content to {output_path}")
                        break
            except Exception as e:
                print(f"Error parsing line: {e}")
else:
    print("Transcript does not exist at this path.")

# If not found, let's scan all folders in brain
print("\nScanning all directories in brain to find any transcript with that text...")
if os.path.exists(brain_dir):
    for root, dirs, files in os.walk(brain_dir):
        if "transcript.jsonl" in files:
            path = os.path.join(root, "transcript.jsonl")
            try:
                with open(path, "r", encoding="utf-8") as f:
                    for line in f:
                        if "Отдел селекции и первичного семеноводства ячменя" in line:
                            data = json.loads(line)
                            content = data.get("content", "")
                            if not content and "tool_calls" in data:
                                content = str(data["tool_calls"])
                            if "Отдел селекции и первичного семеноводства ячменя" in content:
                                print(f"Found match in {path} of length {len(content)}")
                                output_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\untruncated_request.txt"
                                with open(output_path, "w", encoding="utf-8") as out:
                                    out.write(content)
                                print(f"Successfully wrote full content from another file to {output_path}")
                                break
            except Exception as e:
                pass
