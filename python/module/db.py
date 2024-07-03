#!usr/bin/python3
import mysql.connector
from dotenv import load_dotenv
import os
import logging
import time
import io


class Connection:

    def __init__(self):
        load_dotenv()
        self.host = os.getenv("DB_HOST")
        self.port = os.getenv("DB_PORT")
        self.user = os.getenv("DB_USERNAME")
        self.password = os.getenv("DB_PASSWORD")
        self.database = os.getenv("DB_DATABASE")

        self.conn = self.connect_database()

    def connect_database(self, attempts=3, delay=2):
        attempt = 1
        config = {
            "host": self.host,
            "port": self.port,
            "user": self.user,
            "password": self.password,
            "database": self.database,
        }
        logger = logging.getLogger(__name__)
        logger.setLevel(logging.INFO)

        formatter = logging.Formatter(
            "%(asctime)s - %(name)s - %(levelname)s - %(message)s"
        )

        # Log to console
        handler = logging.StreamHandler()
        handler.setFormatter(formatter)
        logger.addHandler(handler)

        # Also log to a file
        file_handler = logging.FileHandler("cpy-errors.log")
        file_handler.setFormatter(formatter)
        logger.addHandler(file_handler)

        # Implement a reconnection routine
        while attempt < attempts + 1:
            try:
                return mysql.connector.connect(**config)
            except (mysql.connector.Error, IOError) as err:
                if attempts is attempt:
                    # Attempts to reconnect failed; returning None
                    logger.info(
                        "Failed to connect, exiting without a connection: %s", err
                    )
                    return None
                logger.info(
                    "Connection failed: %s. Retrying (%d/%d)...",
                    err,
                    attempt,
                    attempts - 1,
                )
                # progressive reconnect delay
                time.sleep(delay**attempt)
                attempt += 1
        return None

    def get_all_data_from_table(self, table_name):
        cursor = self.conn.cursor(
            prepared=True,
        )
        query = f"SELECT * FROM {table_name} ;"
        cursor.execute(query)
        return cursor.fetchall()

    def execute_query(self, query, data=()):
        cursor = self.conn.cursor(
            prepared=True,
        )
        cursor.execute(query, data)
        print(f"Query executed: {cursor.statement}")

    def execute_query_return_all(self, query, data=()):
        cursor = self.conn.cursor(
            prepared=True,
        )
        cursor.execute(query, data)
        return cursor.fetchall()

    def execute_query_return_one(self, query, data=()):
        cursor = self.conn.cursor(
            prepared=True,
        )
        cursor.execute(query, data)
        return cursor.fetchone()

    def check_connection(self):
        return self.conn.is_connected()

    def close(self):
        self.conn.close()
