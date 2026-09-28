import os

base_dir = r"c:\xampp1\htdocs\Sama_College"
found = []

for root, dirs, files in os.walk(base_dir):
    for file in files:
        if file.endswith((".zip", ".rar", ".7z", ".bak")):
            path = os.path.join(root, file)
            print(f"Found backup file in workspace: {path}, Size: {os.path.getsize(path)}")
            found.append(path)

print("Workspace backup search completed.")
