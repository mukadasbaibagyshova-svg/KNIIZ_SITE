import os

def search_word(word):
    found = []
    for root, dirs, files in os.walk('.'):
        # Skip some dirs
        if '.git' in root or '.gemini' in root or 'node_modules' in root:
            continue
        for file in files:
            if file.endswith(('.php', '.css', '.js', '.json')):
                filepath = os.path.join(root, file)
                try:
                    with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                        for i, line in enumerate(f, 1):
                            if word.lower() in line.lower():
                                found.append((filepath, i, line.strip()))
                except Exception as e:
                    pass
    return found

results = search_word('live')
for path, line_no, content in results:
    print(f"{path}:{line_no}: {content}")
