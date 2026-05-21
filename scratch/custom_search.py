with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\questionnaires_clean.txt", "r", encoding="utf-8") as f:
    lines = f.readlines()

keywords = ["пшениц", "ячмен", "свекл", "анкета", "отдел", "руковод", "сотр"]

matches = []
for i, line in enumerate(lines):
    for kw in keywords:
        if kw.lower() in line.lower():
            # grab context around this line (5 lines before and after)
            start = max(0, i - 10)
            end = min(len(lines), i + 10)
            context = "".join(lines[start:end])
            matches.append(f"Line {i} matches '{kw}':\n{context}\n{'-'*40}\n")
            break

with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\search_results.txt", "w", encoding="utf-8") as f_out:
    f_out.write("\n".join(matches))

print(f"Found {len(matches)} matching occurrences.")
