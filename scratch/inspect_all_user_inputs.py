with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\all_user_inputs.txt", "r", encoding="utf-8", errors="ignore") as f:
    content = f.read()

print(f"File size: {len(content)} characters")

# Save a clean copy
with open(r"C:\Users\Asylzat\Desktop\ssssssssss\htdocs\KNIIZ_SITE\scratch\user_inputs_inspected.txt", "w", encoding="utf-8") as out:
    out.write(content)
print("Saved clean copy to scratch/user_inputs_inspected.txt")
