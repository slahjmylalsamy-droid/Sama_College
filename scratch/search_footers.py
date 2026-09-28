import os

base_dir = r"c:\xampp1\htdocs\Sama_College"
found = []

for root, dirs, files in os.walk(base_dir):
    for file in files:
        if file.endswith(".php") and file != "index_reconstructed_all.php":
            path = os.path.join(root, file)
            try:
                with open(path, "r", encoding="utf-8", errors="ignore") as f:
                    content = f.read()
                if "<footer" in content:
                    print(f"Found footer in: {path}")
                    found.append(path)
            except:
                pass
print("Done.")
