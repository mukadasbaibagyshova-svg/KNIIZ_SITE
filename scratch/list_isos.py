import json

path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\extracted_paths.json"
with open(path, 'r', encoding='utf-8') as f:
    data = json.load(f)

with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\iso_list.txt", "w", encoding="utf-8") as f_out:
    for item in data:
        f_out.write(f"ISO: {item['iso']}, RU: {item['name_ru']}, KY: {item['name_ky']}, EN: {item['name_en']}\n")

print("Wrote ISOs to iso_list.txt")
