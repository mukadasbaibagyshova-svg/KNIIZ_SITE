with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\questionnaires_clean.txt", "r", encoding="utf-8") as f:
    text = f.read()

import re

# We want to search for the specific details of the questionnaires that were sent.
# Usually, they contain something like "Анкета" or detailed tables of staff.
# Let's search for lines containing "Руководитель" or similar.
blocks = text.split("=== LINE ")
found = []

for block in blocks:
    if "заведующий" in block.lower() or "заведующая" in block.lower() or "научный сотрудник" in block.lower():
        # Get line header
        header = block.split("\n", 1)[0]
        found.append(f"=== {header} ===\n{block}")

with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\questionnaires_found.txt", "w", encoding="utf-8") as f_out:
    f_out.write("\n\n".join(found))

print(f"Found {len(found)} matching blocks and saved to questionnaires_found.txt")
