import json

matches_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\questionnaire_text.txt"
output_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\questionnaires_clean.txt"

with open(matches_path, 'r', encoding='utf-8') as f:
    text = f.read()

# Let's parse each line from the json
lines = text.split("=== LINE ")
clean_blocks = []

for block in lines:
    if not block.strip():
        continue
    # split by first newline
    parts = block.split("\n", 1)
    if len(parts) < 2:
        continue
    line_num = parts[0].split(" ===")[0]
    json_str = parts[1].strip()
    
    try:
        data = json.loads(json_str)
        content = data.get("content", "")
        source = data.get("source", "")
        t_type = data.get("type", "")
        
        # Only keep if content is non-empty and it is a user input or model response that has questionnaires
        if content and len(content) > 200:
            clean_blocks.append(f"=== LINE {line_num} | TYPE: {t_type} | SOURCE: {source} ===\n{content}\n")
    except Exception as e:
        pass

with open(output_path, 'w', encoding='utf-8') as f_out:
    f_out.write("\n\n".join(clean_blocks))

print(f"Extracted {len(clean_blocks)} clean content blocks to questionnaires_clean.txt")
