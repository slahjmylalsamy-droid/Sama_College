import os

path = r"c:\xampp1\htdocs\Sama_College\scratch\git_recovered_v2_1.php"
if os.path.exists(path):
    with open(path, "r", encoding="utf-8", errors="ignore") as f:
        head = f.read(500)
    print("First 500 chars of git_recovered_v2_1.php:")
    print(repr(head))
else:
    print("File does not exist.")
