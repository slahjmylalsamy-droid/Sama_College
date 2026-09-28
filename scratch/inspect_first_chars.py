path = r"c:\xampp1\htdocs\Sama_College\scratch\git_recovered_v2_1.php"
with open(path, "r", encoding="utf-8", errors="ignore") as f:
    content = f.read()

print("First 1000 characters of git_recovered_v2_1.php:")
print(content[:1000])
