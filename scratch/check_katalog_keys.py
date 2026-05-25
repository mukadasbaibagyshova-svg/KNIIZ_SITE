import re

katalog_path = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\katalog.php"
with open(katalog_path, "r", encoding="utf-8") as f:
    content = f.read()

# Find the sortData block
match = re.search(r"const sortData\s*=\s*(\{.*?\});", content, re.DOTALL)
if match:
    sort_data_str = match.group(1)
    # Find all keys like "naryn27:" or "alta:"
    keys = re.findall(r"\b([a-zA-Z0-9_]+)\s*:\s*\{", sort_data_str)
    print("Keys found in sortData:", keys)
else:
    print("Could not find sortData block")
