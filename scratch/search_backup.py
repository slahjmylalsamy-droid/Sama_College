import os

search_dir = r"c:\xampp1\htdocs\Sama_College"
found = []

for root, dirs, files in os.walk(search_dir):
    for file in files:
        if "index" in file.lower() and file != "index.php":
            found.append(os.path.join(root, file))

print("Found index related files:")
for f in found:
    print(f)
