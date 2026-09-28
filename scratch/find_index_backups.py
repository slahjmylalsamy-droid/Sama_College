import os

base_dir = r"c:\xampp1\htdocs\Sama_College"
found = []

for root, dirs, files in os.walk(base_dir):
    for file in files:
        if "index" in file.lower() and file != "index.php":
            path = os.path.join(root, file)
            print("Found index related file:", path, "Size:", os.path.getsize(path))
            found.append(path)

print("Search completed.")
