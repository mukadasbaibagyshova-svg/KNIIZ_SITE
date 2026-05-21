with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\assets\css\style.css", "r", encoding="utf-8") as f:
    css = f.read()

lines = css.splitlines()
for idx, line in enumerate(lines):
    if any(k in line.lower() for k in ["dot", "blink", "live", "pulse", "chip"]):
        print(f"Line {idx+1}: {line}")
