with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\includes\lang.php", "r", encoding="utf-8") as f:
    lines = f.readlines()

matches = []
for i, line in enumerate(lines):
    if "Изилдөөлөрдүн".lower() in line.lower() or "Түшүмдүүлүк".lower() in line.lower() or "Нарын".lower() in line.lower():
        matches.append(f"Line {i+1}: {line.strip()}")

with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\lang_matches.txt", "w", encoding="utf-8") as f_out:
    f_out.write("\n".join(matches))

print(f"Found {len(matches)} matches in lang.php and saved to lang_matches.txt")
