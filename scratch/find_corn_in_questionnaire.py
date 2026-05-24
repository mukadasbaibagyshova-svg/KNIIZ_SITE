import os

file_path = r"c:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\questionnaire_text.txt"
output_path = r"c:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\search_results_corn.txt"

if os.path.exists(file_path):
    print("File exists. Searching...")
    with open(file_path, "r", encoding="utf-8", errors="ignore") as f:
        content = f.read()
    
    print(f"Total length: {len(content)}")
    
    # Find all occurrences of кукуруз
    idx = 0
    matches = []
    while True:
        idx = content.lower().find("кукуруз", idx)
        if idx == -1:
            break
        matches.append(idx)
        idx += 1
    
    print(f"Found {len(matches)} occurrences of 'кукуруз'.")
    
    with open(output_path, "w", encoding="utf-8") as out:
        for m in matches:
            start = max(0, m - 500)
            end = min(len(content), m + 2000)
            out.write(f"\n\n--- MATCH AT INDEX {m} ---\n")
            out.write(content[start:end])
            out.write("\n-------------------------\n")
    print(f"Wrote search results to {output_path}")
else:
    print("File does not exist.")
