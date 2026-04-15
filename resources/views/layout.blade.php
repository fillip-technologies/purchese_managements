
<style>
*{box-sizing:border-box;margin:0;padding:0}
.app{display:flex;min-height:700px;font-family:var(--font-sans)}
.sidebar{width:230px;flex-shrink:0;background:#0C1B33;display:flex;flex-direction:column;padding:0}
.sidebar-logo{padding:20px 18px 16px;display:flex;align-items:center;gap:10px;border-bottom:1px solid rgba(255,255,255,0.08)}
.logo-mark{width:34px;height:34px;background:#4F8EF7;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.logo-mark svg{width:16px;height:16px;stroke:white;fill:none;stroke-width:2}
.logo-text{font-size:14px;font-weight:500;color:#fff;letter-spacing:0.01em}
.logo-sub{font-size:10px;color:rgba(255,255,255,0.4);margin-top:1px}
.nav-section{padding:14px 10px 6px}
.nav-section-label{font-size:9px;font-weight:500;color:rgba(255,255,255,0.3);text-transform:uppercase;letter-spacing:0.1em;padding:0 8px 6px}
.nav-item{display:flex;align-items:center;gap:9px;padding:8px 10px;border-radius:8px;cursor:pointer;font-size:12.5px;color:rgba(255,255,255,0.55);transition:all 0.15s;margin-bottom:1px}
.nav-item:hover{background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.85)}
.nav-item.active{background:rgba(79,142,247,0.18);color:#7BB3FA;font-weight:500}
.nav-item svg{width:15px;height:15px;flex-shrink:0;stroke:currentColor;fill:none;stroke-width:1.6}
.nav-pill{margin-left:auto;font-size:10px;font-weight:500;padding:2px 7px;border-radius:10px}
.pill-red{background:rgba(226,75,74,0.25);color:#F87171}
.pill-amber{background:rgba(239,159,39,0.2);color:#FBBF24}
.main{flex:1;background:#F4F6FB;display:flex;flex-direction:column;overflow:hidden}
.topbar{background:#fff;border-bottom:1px solid #E8ECF4;padding:12px 22px;display:flex;align-items:center;gap:12px}
.page-title{font-size:15px;font-weight:500;color:#0C1B33;flex:1}
.breadcrumb{font-size:11px;color:#8A94A6;display:flex;align-items:center;gap:4px}
.search{display:flex;align-items:center;gap:8px;background:#F4F6FB;border:1px solid #E0E5EF;border-radius:9px;padding:7px 13px;width:210px}
.search svg{width:13px;height:13px;stroke:#8A94A6;fill:none;stroke-width:2;flex-shrink:0}
.search input{border:none;background:transparent;font-size:12.5px;color:#0C1B33;outline:none;width:100%;font-family:var(--font-sans)}
.topbtn{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:9px;font-size:12.5px;cursor:pointer;font-family:var(--font-sans);transition:all 0.15s;border:1px solid #E0E5EF;background:#fff;color:#3D4D66}
.topbtn:hover{background:#F4F6FB}
.topbtn.accent{background:#4F8EF7;color:#fff;border-color:#4F8EF7}
.topbtn.accent:hover{background:#3A7DE0}
.topbtn svg{width:13px;height:13px;stroke:currentColor;fill:none;stroke-width:2}
.notif-dot{width:8px;height:8px;background:#E24B4A;border-radius:50%;margin-left:2px}
.avatar{width:32px;height:32px;border-radius:50%;background:#4F8EF7;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:500;color:#fff}
.content{flex:1;padding:18px 22px;overflow-y:auto}
.metrics{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-bottom:18px}
.mcard{border-radius:14px;padding:16px 18px;position:relative;overflow:hidden}
.mcard-blue{background:#4F8EF7;color:#fff}
.mcard-purple{background:#7F77DD;color:#fff}
.mcard-teal{background:#1D9E75;color:#fff}
.mcard-coral{background:#D85A30;color:#fff}
.mcard-icon{width:36px;height:36px;border-radius:10px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;margin-bottom:14px}
.mcard-icon svg{width:17px;height:17px;stroke:#fff;fill:none;stroke-width:2}
.mcard-val{font-size:22px;font-weight:500;color:#fff;line-height:1}
.mcard-label{font-size:11px;color:rgba(255,255,255,0.7);margin-top:5px}
.mcard-badge{display:inline-flex;align-items:center;gap:3px;font-size:10px;font-weight:500;padding:3px 7px;border-radius:20px;margin-top:8px}
.badge-up{background:rgba(255,255,255,0.2);color:#fff}
.badge-down{background:rgba(255,255,255,0.2);color:#fff}
.mcard-deco{position:absolute;right:-14px;bottom:-14px;width:70px;height:70px;border-radius:50%;background:rgba(255,255,255,0.1)}
.row2{display:grid;grid-template-columns:minmax(0,1.7fr) minmax(0,1fr);gap:14px;margin-bottom:18px}
.card{background:#fff;border-radius:14px;border:1px solid #E8ECF4;overflow:hidden}
.card-hd{padding:14px 18px;display:flex;align-items:center;gap:10px;border-bottom:1px solid #EEF1F8}
.card-title{font-size:13px;font-weight:500;color:#0C1B33;flex:1}
.tabs{display:flex;gap:3px}
.tab{padding:4px 11px;border-radius:20px;font-size:11px;cursor:pointer;border:1px solid transparent;background:transparent;color:#8A94A6;font-family:var(--font-sans);transition:all 0.15s}
.tab.on{background:#EEF4FF;color:#4F8EF7;border-color:#C8DBFF;font-weight:500}
table{width:100%;border-collapse:collapse;font-size:12.5px;table-layout:fixed}
th{padding:9px 16px;text-align:left;font-size:10px;font-weight:500;color:#8A94A6;text-transform:uppercase;letter-spacing:0.07em;background:#FAFBFD;border-bottom:1px solid #EEF1F8}
td{padding:10px 16px;border-bottom:1px solid #EEF1F8;color:#2D3A52;vertical-align:middle;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
tr:last-child td{border-bottom:none}
tr:hover td{background:#F9FBFF}
.po-num{font-weight:500;color:#0C1B33;font-size:12px}
.vendor-cell{display:flex;align-items:center;gap:8px}
.vav{width:24px;height:24px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:9px;font-weight:500;flex-shrink:0}
.status-pill{display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:20px;font-size:11px;font-weight:500}
.s-pending{background:#FFF3E0;color:#D36B00}
.s-approved{background:#E6F7EE;color:#17894B}
.s-received{background:#EEF4FF;color:#2C6EE0}
.s-draft{background:#F1EFE8;color:#5F5E5A}
.s-cancelled{background:#FFF0F0;color:#C0392B}
.prio{display:flex;align-items:center;gap:5px;font-size:11.5px}
.dot{width:7px;height:7px;border-radius:50%;flex-shrink:0}
.d-h{background:#E24B4A}.d-m{background:#EF9F27}.d-l{background:#97C459}
.act-btn{padding:4px 11px;border-radius:7px;font-size:11px;cursor:pointer;border:1px solid #E0E5EF;background:#fff;color:#3D4D66;font-family:var(--font-sans);transition:all 0.15s}
.act-btn:hover{background:#F4F6FB;border-color:#C8DBFF;color:#4F8EF7}
.spend-bar-wrap{padding:14px 18px;display:flex;flex-direction:column;gap:12px}
.srow{display:flex;align-items:center;gap:10px}
.slabel{font-size:11px;color:#8A94A6;width:54px;text-align:right;flex-shrink:0}
.strack{flex:1;height:7px;background:#F1F3F9;border-radius:4px;overflow:hidden}
.sfill{height:100%;border-radius:4px}
.sval{font-size:11px;color:#3D4D66;font-weight:500;width:38px;flex-shrink:0;text-align:right}
.approvals-list{display:flex;flex-direction:column}
.ap-item{display:flex;align-items:center;gap:10px;padding:11px 16px;border-bottom:1px solid #EEF1F8}
.ap-item:last-child{border-bottom:none}
.apav{width:34px;height:34px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:500;flex-shrink:0}
.ap-info{flex:1;min-width:0}
.ap-name{font-size:12.5px;font-weight:500;color:#0C1B33;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.ap-meta{font-size:11px;color:#8A94A6;margin-top:2px}
.ap-amt{font-size:12.5px;font-weight:500;color:#0C1B33;flex-shrink:0;margin-right:6px}
.ap-ok{padding:5px 11px;border-radius:7px;font-size:11px;cursor:pointer;border:1px solid #9FE1CB;background:#E1F5EE;color:#0F6E56;font-family:var(--font-sans)}
.ap-no{padding:5px 10px;border-radius:7px;font-size:11px;cursor:pointer;border:1px solid #E0E5EF;background:#fff;color:#8A94A6;font-family:var(--font-sans)}
.urgency-tag{font-size:10px;font-weight:500;padding:2px 7px;border-radius:20px}
.u-high{background:#FFF0F0;color:#C0392B}
.u-med{background:#FFF9E6;color:#D36B00}
</style>

<h2 class="sr-only">Purchase management admin dashboard with metrics, order table, spend breakdown, and approval queue</h2>

<div class="app">
  <div class="sidebar">
    <div class="sidebar-logo">
      <div class="logo-mark">
        <svg viewBox="0 0 16 16"><rect x="2" y="3" width="12" height="10" rx="1.5"/><path d="M5 3V2a1 1 0 012 0v1M9 3V2a1 1 0 012 0v1"/><path d="M4 8h8M4 11h5"/></svg>
      </div>
      <div>
        <div class="logo-text">ProcureIQ</div>
        <div class="logo-sub">Admin Console</div>
      </div>
    </div>

    <div class="nav-section">
      <div class="nav-section-label">Workspace</div>
      <div class="nav-item active">
        <svg viewBox="0 0 16 16"><rect x="1" y="1" width="6" height="6" rx="1"/><rect x="9" y="1" width="6" height="6" rx="1"/><rect x="1" y="9" width="6" height="6" rx="1"/><rect x="9" y="9" width="6" height="6" rx="1"/></svg>
        Dashboard
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 16 16"><path d="M2 4h12M4 4V3a1 1 0 011-1h6a1 1 0 011 1v1"/><rect x="2" y="4" width="12" height="10" rx="1"/></svg>
        Purchase Orders
        <span class="nav-pill pill-red">12</span>
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2 2"/></svg>
        Approvals
        <span class="nav-pill pill-amber">5</span>
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 16 16"><path d="M3 2h10l1 9H2L3 2z"/><path d="M6 14a1 1 0 100-2 1 1 0 000 2zM11 14a1 1 0 100-2 1 1 0 000 2z"/></svg>
        Requisitions
      </div>
    </div>

    <div class="nav-section">
      <div class="nav-section-label">Procurement</div>
      <div class="nav-item">
        <svg viewBox="0 0 16 16"><path d="M8 2L10 6h4l-3 3 1 4-4-2.5L4 13l1-4L2 6h4z"/></svg>
        Vendors
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 16 16"><rect x="2" y="5" width="12" height="9" rx="1"/><path d="M5 5V4a3 3 0 016 0v1"/></svg>
        Contracts
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 16 16"><path d="M2 11l4-5 3 3 2-2 3 4"/><rect x="2" y="2" width="12" height="12" rx="1"/></svg>
        Spend Analytics
      </div>
    </div>

    <div class="nav-section">
      <div class="nav-section-label">Finance</div>
      <div class="nav-item">
        <svg viewBox="0 0 16 16"><path d="M8 2v12M5 4h4.5a2.5 2.5 0 010 5H5m0 0h5"/></svg>
        Budget Tracker
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 16 16"><path d="M2 14V6l6-4 6 4v8M6 14v-4h4v4"/></svg>
        Invoices
      </div>
      <div class="nav-item">
        <svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2 2"/></svg>
        Reports
      </div>
    </div>

    <div style="margin-top:auto;padding:14px 10px;border-top:1px solid rgba(255,255,255,0.07)">
      <div class="nav-item">
        <svg viewBox="0 0 16 16" style="width:15px;height:15px"><circle cx="8" cy="6" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/></svg>
        <span>Arjun Sharma</span>
        <div style="margin-left:auto;width:7px;height:7px;background:#1D9E75;border-radius:50%"></div>
      </div>
    </div>
  </div>

  <div class="main">
    <div class="topbar">
      <div>
        <div class="page-title">Dashboard</div>
        <div class="breadcrumb">Home <span style="opacity:.4">›</span> Overview</div>
      </div>
      <div style="flex:1"></div>
      <div class="search">
        <svg viewBox="0 0 16 16"><circle cx="7" cy="7" r="4"/><path d="M10 10l3 3"/></svg>
        <input placeholder="Search orders, vendors…">
      </div>
      <button class="topbtn">
        <svg viewBox="0 0 16 16"><path d="M2 5h12M4 8h8M6 11h4"/></svg>
        Filter
      </button>
      <button class="topbtn">
        <svg viewBox="0 0 16 16"><path d="M8 3v10M13 8l-5 5-5-5"/></svg>
        Export
      </button>
      <button class="topbtn accent" onclick="sendPrompt('Create a new purchase order for me')">
        <svg viewBox="0 0 16 16"><path d="M8 3v10M3 8h10"/></svg>
        New PO ↗
      </button>
      <div style="position:relative">
        <button class="topbtn" style="padding:7px 10px">
          <svg viewBox="0 0 16 16" style="width:15px;height:15px"><path d="M8 2a5 5 0 014.9 6c.7.5 1.1 1.3 1.1 2.1 0 .5-.4.9-.9.9H2.9c-.5 0-.9-.4-.9-.9 0-.8.4-1.6 1.1-2.1A5 5 0 018 2z"/><path d="M6.5 14a1.5 1.5 0 003 0"/></svg>
        </button>
        <div class="notif-dot" style="position:absolute;top:4px;right:4px;width:7px;height:7px"></div>
      </div>
      <div class="avatar">AS</div>
    </div>

    <div class="content">
      <div class="metrics">
        <div class="mcard mcard-blue">
          <div class="mcard-deco"></div>
          <div class="mcard-icon"><svg viewBox="0 0 16 16"><path d="M2 2h12v12H2zM5 8h6M5 10.5h4"/><path d="M2 5h12"/></svg></div>
          <div class="mcard-val">$248,320</div>
          <div class="mcard-label">Total spend — April</div>
          <span class="mcard-badge badge-up">▲ 8.4% vs last month</span>
        </div>
        <div class="mcard mcard-purple">
          <div class="mcard-deco"></div>
          <div class="mcard-icon"><svg viewBox="0 0 16 16"><path d="M2 4h12M4 4V3a1 1 0 011-1h6a1 1 0 011 1v1"/><rect x="2" y="4" width="12" height="10" rx="1"/></svg></div>
          <div class="mcard-val">34</div>
          <div class="mcard-label">Open purchase orders</div>
          <span class="mcard-badge badge-up">12 pending approval</span>
        </div>
        <div class="mcard mcard-teal">
          <div class="mcard-deco"></div>
          <div class="mcard-icon"><svg viewBox="0 0 16 16"><circle cx="8" cy="8" r="6"/><path d="M8 5v3l2 2"/></svg></div>
          <div class="mcard-val">3.2 days</div>
          <div class="mcard-label">Avg. approval cycle time</div>
          <span class="mcard-badge badge-down">▼ 0.5d slower this week</span>
        </div>
        <div class="mcard mcard-coral">
          <div class="mcard-deco"></div>
          <div class="mcard-icon"><svg viewBox="0 0 16 16"><path d="M8 2v12M5 4h4.5a2.5 2.5 0 010 5H5m0 0h5"/></svg></div>
          <div class="mcard-val">$91,680</div>
          <div class="mcard-label">Q2 budget remaining</div>
          <span class="mcard-badge badge-up">of $340,000 allocated</span>
        </div>
      </div>

      <div class="card" style="margin-bottom:14px">
        <div class="card-hd">
          <div class="card-title">Purchase orders</div>
          <div class="tabs">
            <button class="tab on">All</button>
            <button class="tab">Pending</button>
            <button class="tab">Approved</button>
            <button class="tab">Received</button>
          </div>
          <button class="act-btn" style="margin-left:8px" onclick="sendPrompt('Show me full list of all purchase orders with details')">View all ↗</button>
        </div>
        <table>
          <thead>
            <tr>
              <th style="width:110px">PO Number</th>
              <th style="width:140px">Vendor</th>
              <th style="width:100px">Category</th>
              <th style="width:90px">Amount</th>
              <th style="width:80px">Priority</th>
              <th style="width:90px">Status</th>
              <th style="width:70px">Date</th>
              <th style="width:60px"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="po-num">PO-2024-0891</td>
              <td><div class="vendor-cell"><div class="vav" style="background:#EEF4FF;color:#2C6EE0">TN</div>TechNova Inc.</div></td>
              <td style="color:#8A94A6">IT Equipment</td>
              <td style="font-weight:500;color:#0C1B33">$42,500</td>
              <td><span class="prio"><span class="dot d-h"></span>High</span></td>
              <td><span class="status-pill s-pending">Pending</span></td>
              <td style="color:#8A94A6">Apr 14</td>
              <td><button class="act-btn">View</button></td>
            </tr>
            <tr>
              <td class="po-num">PO-2024-0890</td>
              <td><div class="vendor-cell"><div class="vav" style="background:#E1F5EE;color:#0F6E56">OS</div>OfficeSupply Co.</div></td>
              <td style="color:#8A94A6">Office</td>
              <td style="font-weight:500;color:#0C1B33">$3,210</td>
              <td><span class="prio"><span class="dot d-l"></span>Low</span></td>
              <td><span class="status-pill s-approved">Approved</span></td>
              <td style="color:#8A94A6">Apr 13</td>
              <td><button class="act-btn">View</button></td>
            </tr>
            <tr>
              <td class="po-num">PO-2024-0889</td>
              <td><div class="vendor-cell"><div class="vav" style="background:#FBEAF0;color:#72243E">GS</div>Global Shipping</div></td>
              <td style="color:#8A94A6">Logistics</td>
              <td style="font-weight:500;color:#0C1B33">$18,750</td>
              <td><span class="prio"><span class="dot d-m"></span>Medium</span></td>
              <td><span class="status-pill s-received">Received</span></td>
              <td style="color:#8A94A6">Apr 12</td>
              <td><button class="act-btn">View</button></td>
            </tr>
            <tr>
              <td class="po-num">PO-2024-0888</td>
              <td><div class="vendor-cell"><div class="vav" style="background:#FAEEDA;color:#633806">ML</div>MetaLabs</div></td>
              <td style="color:#8A94A6">R&D Tools</td>
              <td style="font-weight:500;color:#0C1B33">$67,000</td>
              <td><span class="prio"><span class="dot d-h"></span>High</span></td>
              <td><span class="status-pill s-pending">Pending</span></td>
              <td style="color:#8A94A6">Apr 11</td>
              <td><button class="act-btn">View</button></td>
            </tr>
            <tr>
              <td class="po-num">PO-2024-0887</td>
              <td><div class="vendor-cell"><div class="vav" style="background:#EEEDFE;color:#3C3489">CW</div>CloudWorks</div></td>
              <td style="color:#8A94A6">SaaS</td>
              <td style="font-weight:500;color:#0C1B33">$9,800</td>
              <td><span class="prio"><span class="dot d-m"></span>Medium</span></td>
              <td><span class="status-pill s-draft">Draft</span></td>
              <td style="color:#8A94A6">Apr 10</td>
              <td><button class="act-btn">View</button></td>
            </tr>
            <tr>
              <td class="po-num">PO-2024-0886</td>
              <td><div class="vendor-cell"><div class="vav" style="background:#FCEBEB;color:#791F1F">SP</div>SafePrint</div></td>
              <td style="color:#8A94A6">Marketing</td>
              <td style="font-weight:500;color:#0C1B33">$5,440</td>
              <td><span class="prio"><span class="dot d-l"></span>Low</span></td>
              <td><span class="status-pill s-cancelled">Cancelled</span></td>
              <td style="color:#8A94A6">Apr 9</td>
              <td><button class="act-btn">View</button></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="row2">
        <div class="card">
          <div class="card-hd">
            <div class="card-title">Pending approvals</div>
            <span style="font-size:11px;background:#FFF3E0;color:#D36B00;padding:3px 9px;border-radius:20px;font-weight:500">5 urgent</span>
            <button class="act-btn" style="margin-left:8px" onclick="sendPrompt('Show detailed approval queue with all pending POs')">View all ↗</button>
          </div>
          <div class="approvals-list">
            <div class="ap-item">
              <div class="apav" style="background:#EEF4FF;color:#2C6EE0">TN</div>
              <div class="ap-info">
                <div class="ap-name">TechNova — Laptops ×20</div>
                <div class="ap-meta">J. Kim · IT Dept · Apr 14</div>
              </div>
              <span class="urgency-tag u-high">Urgent</span>
              <span class="ap-amt" style="margin-left:8px">$42,500</span>
              <button class="ap-ok">Approve</button>
              <button class="ap-no" style="margin-left:4px">Reject</button>
            </div>
            <div class="ap-item">
              <div class="apav" style="background:#FAEEDA;color:#633806">ML</div>
              <div class="ap-info">
                <div class="ap-name">MetaLabs — Research licenses</div>
                <div class="ap-meta">S. Patel · R&D Dept · Apr 11</div>
              </div>
              <span class="urgency-tag u-high">Urgent</span>
              <span class="ap-amt" style="margin-left:8px">$67,000</span>
              <button class="ap-ok">Approve</button>
              <button class="ap-no" style="margin-left:4px">Reject</button>
            </div>
            <div class="ap-item">
              <div class="apav" style="background:#E1F5EE;color:#0F6E56">AV</div>
              <div class="ap-info">
                <div class="ap-name">AV Solutions — Conference system</div>
                <div class="ap-meta">D. Torres · Facilities · Apr 10</div>
              </div>
              <span class="urgency-tag u-med">Medium</span>
              <span class="ap-amt" style="margin-left:8px">$14,200</span>
              <button class="ap-ok">Approve</button>
              <button class="ap-no" style="margin-left:4px">Reject</button>
            </div>
            <div class="ap-item">
              <div class="apav" style="background:#EEEDFE;color:#3C3489">NS</div>
              <div class="ap-info">
                <div class="ap-name">NetSafe — Annual subscription</div>
                <div class="ap-meta">R. Gupta · Security · Apr 9</div>
              </div>
              <span class="urgency-tag u-med">Medium</span>
              <span class="ap-amt" style="margin-left:8px">$8,600</span>
              <button class="ap-ok">Approve</button>
              <button class="ap-no" style="margin-left:4px">Reject</button>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-hd">
            <div class="card-title">Spend by category</div>
            <span style="font-size:11px;color:#8A94A6">April 2026</span>
          </div>
          <div class="spend-bar-wrap">
            <div class="srow">
              <div class="slabel">IT</div>
              <div class="strack"><div class="sfill" style="width:82%;background:#4F8EF7"></div></div>
              <div class="sval">$82k</div>
            </div>
            <div class="srow">
              <div class="slabel">R&D</div>
              <div class="strack"><div class="sfill" style="width:67%;background:#7F77DD"></div></div>
              <div class="sval">$67k</div>
            </div>
            <div class="srow">
              <div class="slabel">Logistics</div>
              <div class="strack"><div class="sfill" style="width:47%;background:#1D9E75"></div></div>
              <div class="sval">$47k</div>
            </div>
            <div class="srow">
              <div class="slabel">SaaS</div>
              <div class="strack"><div class="sfill" style="width:31%;background:#D85A30"></div></div>
              <div class="sval">$31k</div>
            </div>
            <div class="srow">
              <div class="slabel">Office</div>
              <div class="strack"><div class="sfill" style="width:18%;background:#D4537E"></div></div>
              <div class="sval">$18k</div>
            </div>
            <div class="srow">
              <div class="slabel">Other</div>
              <div class="strack"><div class="sfill" style="width:10%;background:#888780"></div></div>
              <div class="sval">$10k</div>
            </div>
          </div>
          <div style="margin:0 18px 14px;padding-top:12px;border-top:1px solid #EEF1F8">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
              <span style="font-size:11px;color:#8A94A6">Q2 budget utilization</span>
              <span style="font-size:12px;font-weight:500;color:#0C1B33">73%</span>
            </div>
            <div style="height:6px;background:#F1F3F9;border-radius:4px;overflow:hidden">
              <div style="width:73%;height:100%;background:#4F8EF7;border-radius:4px"></div>
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:5px">
              <span style="font-size:10px;color:#8A94A6">$248,320 spent</span>
              <span style="font-size:10px;color:#8A94A6">$340,000 total</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.querySelectorAll('.tab').forEach(t=>{
  t.addEventListener('click',function(){
    this.closest('.tabs').querySelectorAll('.tab').forEach(x=>x.classList.remove('on'));
    this.classList.add('on');
  });
});
document.querySelectorAll('.ap-ok').forEach(b=>{
  b.addEventListener('click',function(){
    const row=this.closest('.ap-item');
    row.style.opacity='0.4';
    row.style.pointerEvents='none';
    this.textContent='Approved';
    this.style.background='#E1F5EE';
    this.style.color='#0F6E56';
  });
});
document.querySelectorAll('.ap-no').forEach(b=>{
  b.addEventListener('click',function(){
    const row=this.closest('.ap-item');
    row.style.opacity='0.35';
    row.style.pointerEvents='none';
  });
});
document.querySelectorAll('.nav-item').forEach(n=>{
  n.addEventListener('click',function(){
    document.querySelectorAll('.nav-item').forEach(x=>x.classList.remove('active'));
    this.classList.add('active');
  });
});
</script>
