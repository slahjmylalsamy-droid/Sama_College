import mysql.connector

try:
    conn = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="sama_college"
    )
    cursor = conn.cursor()
    
    # Get tables
    cursor.execute("SHOW TABLES")
    tables = [t[0] for t in cursor.fetchall()]
    print("Tables in sama_college database:")
    for table in tables:
        print(f"\n--- Table: {table} ---")
        cursor.execute(f"DESCRIBE `{table}`")
        for col in cursor.fetchall():
            print(f"  Column: {col[0]} - Type: {col[1]} - Null: {col[2]} - Key: {col[3]} - Default: {col[4]}")
            
    conn.close()
except Exception as e:
    print(f"Error: {e}")
