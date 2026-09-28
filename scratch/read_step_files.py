with open("scratch/step_7191_target.txt", "r", encoding="utf-8") as f:
    target = f.read()

print("Target content length:", len(target))
print("First 200 chars:")
print(target[:200])
print("\nLast 200 chars:")
print(target[-200:])
