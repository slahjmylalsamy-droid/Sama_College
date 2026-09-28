import os

user_dirs = [
    r"C:\Users\asus\Downloads",
    r"C:\Users\asus\Documents",
    r"C:\Users\asus\Desktop",
    r"C:\Users\asus\OneDrive",
    r"C:\Users\asus\OneDrive\Documents",
    r"C:\Users\asus\OneDrive\Desktop"
]

found = []

for d in user_dirs:
    if os.path.exists(d):
        print("Searching folder:", d)
        for root, dirs, files in os.walk(d):
            # Keep it shallow and fast
            if root.count(os.sep) > 6:
                dirs.clear()
                continue
            for file in files:
                if file == "index.php":
                    path = os.path.join(root, file)
                    try:
                        size = os.path.getsize(path)
                        # Check size range of index.php (240KB to 285KB)
                        # The original index.php should be in this range
                        if 240000 <= size <= 285000:
                            print(f"Found match: {path}, Size: {size}")
                            found.append((path, size))
                    except Exception as e:
                        continue

print("Search completed. Total matches:", len(found))
if found:
    # Print the path of the first match
    print("Restore path candidate:", found[0][0])
