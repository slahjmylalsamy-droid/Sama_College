import os

art_dir = r"C:\Users\asus\.gemini\antigravity\brain\e69fa78a-8e64-4837-8d43-af117029d7d9"
large_files = []

for root, dirs, files in os.walk(art_dir):
    for file in files:
        path = os.path.join(root, file)
        try:
            size = os.path.getsize(path)
            if size > 150000: # Files larger than 150KB
                print("Found large artifact:", path, "Size:", size)
                large_files.append((path, size))
        except Exception as e:
            continue

print("Done scanning artifacts.")
