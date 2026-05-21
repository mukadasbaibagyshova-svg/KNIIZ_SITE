import re

svg_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\assets\images\kyrgyzstan_provinces.svg"

with open(svg_path, 'r', encoding='utf-8') as f:
    content = f.read()

svg_tag = re.search(r'<svg[^>]+>', content)
if svg_tag:
    print(svg_tag.group(0))
else:
    print("No svg tag found")
