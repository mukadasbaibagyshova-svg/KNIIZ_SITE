import os

path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\questionnaire_text.txt"
with open(path, "r", encoding="utf-8", errors="ignore") as f:
    content = f.read()

out_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\search_results_corn.txt"
with open(out_path, "w", encoding="utf-8") as out:
    for kw in ["кукурузы", "пшеницы", "сахарной свеклы", "Sugar Beet", "Wheat", "Corn"]:
        idx = 0
        out.write(f"\n========================================\n")
        out.write(f"Matches for '{kw}'\n")
        out.write(f"========================================\n")
        while True:
            idx = content.find(kw, idx)
            if idx == -1:
                break
            out.write(f"Position {idx}:\n")
            start = max(0, idx - 200)
            end = min(len(content), idx + 2000)
            out.write(content[start:end])
            out.write("\n" + "-" * 40 + "\n")
            idx += len(kw)

print("Successfully wrote search results to search_results_corn.txt")
