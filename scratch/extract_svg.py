import re
import json

svg_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\assets\images\kyrgyzstan_provinces.svg"
output_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\extracted_paths.json"

with open(svg_path, 'r', encoding='utf-8') as f:
    content = f.read()

paths = re.findall(r'<path[^>]+>', content)
extracted = []

# Mappings for regions
names_map = {
    "KG-Y": {"ru": "Иссык-Кульская область", "ky": "Ысык-Көл облусу", "en": "Issyk-Kul Region"},
    "KG-N": {"ru": "Нарынская область", "ky": "Нарын облусу", "en": "Naryn Region"},
    "KG-C": {"ru": "Чуйская область", "ky": "Чүй облусу", "en": "Chuy Region"},
    "KG-T": {"ru": "Таласская область", "ky": "Талас облусу", "en": "Talas Region"},
    "KG-J": {"ru": "Джалал-Абадская область", "ky": "Жалал-Абад облусу", "en": "Jalal-Abad Region"},
    "KG-O": {"ru": "Ошская область", "ky": "Ош облусу", "en": "Osh Region"},
    "KG-B": {"ru": "Баткенская область", "ky": "Баткен облусу", "en": "Batken Region"},
    "KG-GB": {"ru": "Бишкек", "ky": "Бишкек", "en": "Bishkek"},
    "KG-GO": {"ru": "Ош (город)", "ky": "Ош (шаар)", "en": "Osh City"}
}

for i, path in enumerate(paths):
    name = re.search(r'name="([^"]+)"', path)
    name_en = re.search(r'name_en="([^"]+)"', path)
    iso = re.search(r'iso_3166_2="([^"]+)"', path)
    d = re.search(r'd="([^"]+)"', path)
    
    name_val = name.group(1) if name else "Unknown"
    name_en_val = name_en.group(1) if name_en else "Unknown"
    iso_val = iso.group(1) if iso else f"path_{i}"
    d_val = d.group(1) if d else ""
    
    names = names_map.get(iso_val, {"ru": name_val, "ky": name_val, "en": name_en_val})
    
    extracted.append({
        "iso": iso_val,
        "name_ru": names["ru"],
        "name_ky": names["ky"],
        "name_en": names["en"],
        "d": d_val
    })

with open(output_path, 'w', encoding='utf-8') as f:
    json.dump(extracted, f, indent=4, ensure_ascii=False)

print(f"Successfully extracted {len(extracted)} paths to {output_path}")
