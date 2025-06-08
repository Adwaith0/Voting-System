# 🗳️ Distributed Online Voting System

A secure, scalable, and fault-tolerant online voting platform built using distributed system principles. This system allows users to register, log in, and vote securely from anywhere, while administrators manage candidates and monitor real-time results.

---

## 📌 Features

- 🧑‍💼 **User Authentication** – Secure login and registration system for voters and admins.
- ✅ **One Vote per User** – Enforced through session and database constraints.
- 🗂️ **Candidate Management** – Admin dashboard for adding, editing, and removing candidates.
- 🧮 **Real-Time Vote Counting** – Votes are updated instantly and reflected live.
- 🔄 **Fault Tolerance** – Replicated databases ensure availability during server failures.
- 📊 **Results Visualization** – Clean UI showing live election results.
- 🔐 **Session Security** – Protected endpoints, secure cookies, and session management.

---

## 🏗️ System Architecture

The system follows a distributed client-server model. It consists of:

- **Frontend:** HTML, CSS, JavaScript (Bootstrap for UI)
- **Backend:** PHP
- **Database:** MySQL with master-slave replication (for fault tolerance)
- **Server:** Apache (XAMPP or any LAMP stack)

> 🖼️ *Architecture diagram and sequence flowcharts are available in the `/docs` folder.*

---

## 🔧 Installation and Setup

### Prerequisites
- PHP 7+
- MySQL
- Apache server (XAMPP or LAMP)
- Git

### Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/distributed-voting-system.git
   cd distributed-voting-system
