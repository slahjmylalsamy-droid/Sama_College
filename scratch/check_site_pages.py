import mysql.connector
import sys
sys.stdout.reconfigure(encoding='utf-8')

try:
    conn = mysql.connector.connect(host="localhost", user="root", password="", database="sama_college")
    cursor = conn.cursor()
    
    # Let's see what tables we have
    cursor.execute("SHOW TABLES")
    print("Tables:")
    for t in cursor:
        print("  ", t[0])
    
    # Check site_pages keys
    cursor.execute("SELECT page_key FROM site_pages")
    print("\nsite_pages page_keys:")
    for r in cursor:
        print("  ", r[0])
        
    # Check announcements table description and count
    cursor.execute("SELECT COUNT(*) FROM announcements")
    print("\nAnnouncements count:", cursor.fetchone()[0])
    
    cursor.execute("DESCRIBE announcements")
    print("\nAnnouncements columns:")
    for col in cursor:
        print("  ", col[0], col[1])
        
    # Fetch first few announcements
    cursor.execute("SELECT * FROM announcements ORDER BY created_at DESC LIMIT 5")
    print("\nLatest announcements:")
    for r in cursor:
        print("  ", r)
        
    conn.close()
except Exception as e:
    print("Error:", e)
