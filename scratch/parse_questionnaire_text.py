import os

path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\questionnaire_text.txt"
print(f"File size: {os.path.getsize(path)} bytes")

# Read first 1000 characters
with open(path, "r", encoding="utf-8", errors="ignore") as f:
    content = f.read()

print(f"Total characters: {len(content)}")

# Let's search for "Отдел селекции"
idx = 0
found_positions = []
while True:
    idx = content.find("Отдел селекции", idx)
    if idx == -1:
        break
    found_positions.append(idx)
    idx += 1

print(f"Found 'Отдел селекции' {len(found_positions)} times.")
for pos in found_positions[:10]:
    print(f"  Position {pos}: {content[pos:pos+150]}...")
