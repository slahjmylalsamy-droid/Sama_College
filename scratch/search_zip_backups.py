import os

user_dirs = [
    r"C:\Users\asus\Downloads",
    r"C:\Users\asus\Documents",
    r"C:\Users\asus\Desktop",
    r"C:\Users\asus\OneDrive"
]

found = []

for d in user_dirs:
    if os.path.exists(d):
        print("Searching archive files in:", d)
        for root, dirs, files in os.walk(d):
            if root.count(os.sep) > 5:
                dirs.clear()
                continue
            for file in files:
                if file.endswith((".zip", ".rar", ".7z")):
                    if "sama" in file.lower() or "college" in file.lower() or "htdocs" in file.lower():
                        path = os.path.join(root, file)
                        try:
                            size = os.path.getsize(path)
                            print(f"Found archive: {path}, Size: {size}")
                            found.append(path)
                        except:
                            continue

print("Completed archive search. Found:", len(found))
