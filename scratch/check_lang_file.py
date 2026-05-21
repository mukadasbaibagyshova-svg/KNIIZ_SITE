with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\includes\lang.php", "r", encoding="utf-8") as f:
    text = f.read()

import re

# Find keys related to structure or departments
keys = re.findall(r"'\w*structure\w*' => '.*'", text)
print(f"Found {len(keys)} keys:")
for k in keys[:20]:
    print(k)
