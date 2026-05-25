import os

scratch_dir = r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch"
for filename in os.listdir(scratch_dir):
    if filename.endswith(".txt"):
        filepath = os.path.join(scratch_dir, filename)
        try:
            with open(filepath, "r", encoding="utf-8") as f:
                content = f.read()
                if "ЖАЗДЫК АРПА" in content or "ЯРОВОЙ ЯЧМЕНЬ" in content or "АЛЬТА" in content:
                    print(f"Found keyword in {filename}, size: {len(content)} characters")
        except Exception as e:
            pass
