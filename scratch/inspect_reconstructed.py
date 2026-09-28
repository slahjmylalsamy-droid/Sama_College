with open("index_reconstructed_all.php", "r", encoding="utf-8", errors="ignore") as f:
    lines = f.readlines()

print(f"Total lines: {len(lines)}")
print("First 20 lines:")
for l in lines[:20]:
    print(l.strip())
