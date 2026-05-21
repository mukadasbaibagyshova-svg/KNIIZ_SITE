import json

json_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\extracted_paths.json"

with open(json_path, "r", encoding="utf-8") as f:
    data = json.load(f)

summary = []
for i, item in enumerate(data):
    summary.append(f"Index {i}:")
    summary.append(f"  iso: {item.get('iso')}")
    summary.append(f"  name_ru: {item.get('name_ru')}")
    summary.append(f"  name_ky: {item.get('name_ky')}")
    summary.append(f"  name_en: {item.get('name_en')}")
    summary.append(f"  d: {item.get('d')[:100]}...")

with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\paths_summary.txt", "w", encoding="utf-8") as f_out:
    f_out.write("\n".join(summary))

print("Saved path summary to paths_summary.txt")
