import os

possible_dirs = [
    r"C:\Program Files",
    r"C:\Program Files (x86)",
    r"C:\Users\asus\AppData\Local\Programs",
    r"C:\Users\asus\AppData\Local",
    r"C:\xampp1"
]

found = []

for d in possible_dirs:
    if os.path.exists(d):
        for root, dirs, files in os.walk(d):
            # stop deep nesting to keep it fast
            if root.count(os.sep) > 5:
                # clear dirs to not recurse deep
                dirs.clear()
                continue
            if "git.exe" in files:
                path = os.path.join(root, "git.exe")
                found.append(path)
                print("Found git:", path)

print("Finished searching common folders. Found:", len(found))
