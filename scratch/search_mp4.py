import os

search_dir = r"c:\xampp1\htdocs\Sama_College"
found = []

for root, dirs, files in os.walk(search_dir):
    for file in files:
        if file.endswith(".mp4"):
            found.append(os.path.join(root, file))

print("Found MP4 files:")
for f in found:
    print(f)
