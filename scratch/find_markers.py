with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\questionnaire_text.txt", "r", encoding="utf-8") as f:
    text = f.read()

import re
matches = re.findall(r"=== LINE \d+ ===", text)
print(f"Total markers in text: {len(matches)}")
for m in matches[:30]:
    print(m)
