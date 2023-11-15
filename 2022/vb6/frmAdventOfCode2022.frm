VERSION 5.00
Object = "{831FDD16-0C5C-11D2-A9FC-0000F8754DA1}#2.0#0"; "MSCOMCTL.OCX"
Begin VB.Form frmAdventOfCode2022 
   Caption         =   "Form1"
   ClientHeight    =   4980
   ClientLeft      =   120
   ClientTop       =   465
   ClientWidth     =   7845
   LinkTopic       =   "Form1"
   LockControls    =   -1  'True
   ScaleHeight     =   4980
   ScaleWidth      =   7845
   StartUpPosition =   3  'Windows Default
   Begin VB.Frame frmDays0105 
      BorderStyle     =   0  'None
      Height          =   4215
      Left            =   240
      TabIndex        =   1
      Top             =   480
      Width           =   7335
      Begin VB.TextBox txtPart2Answer 
         Height          =   375
         Index           =   1
         Left            =   3600
         Locked          =   -1  'True
         TabIndex        =   17
         Top             =   1800
         Width           =   2055
      End
      Begin VB.TextBox txtPart2Test 
         Enabled         =   0   'False
         Height          =   375
         Index           =   1
         Left            =   2280
         Locked          =   -1  'True
         TabIndex        =   16
         Top             =   1800
         Width           =   1215
      End
      Begin VB.TextBox txtPart1Answer 
         Height          =   375
         Index           =   1
         Left            =   3600
         Locked          =   -1  'True
         TabIndex        =   14
         Top             =   1320
         Width           =   2055
      End
      Begin VB.TextBox txtPart1Test 
         Enabled         =   0   'False
         Height          =   375
         Index           =   1
         Left            =   2280
         Locked          =   -1  'True
         TabIndex        =   13
         Top             =   1320
         Width           =   1215
      End
      Begin VB.TextBox txtPart1Test 
         Enabled         =   0   'False
         Height          =   375
         Index           =   0
         Left            =   2280
         Locked          =   -1  'True
         TabIndex        =   6
         Top             =   240
         Width           =   1215
      End
      Begin VB.TextBox txtPart2Test 
         Enabled         =   0   'False
         Height          =   375
         Index           =   0
         Left            =   2280
         Locked          =   -1  'True
         TabIndex        =   9
         Top             =   720
         Width           =   1215
      End
      Begin VB.TextBox txtPart2Answer 
         Height          =   375
         Index           =   0
         Left            =   3600
         Locked          =   -1  'True
         TabIndex        =   10
         Top             =   720
         Width           =   2055
      End
      Begin VB.TextBox txtPart1Answer 
         Height          =   375
         Index           =   0
         Left            =   3600
         Locked          =   -1  'True
         TabIndex        =   7
         Top             =   240
         Width           =   2055
      End
      Begin VB.Label lblDay 
         Caption         =   "Day 2"
         Height          =   255
         Index           =   1
         Left            =   0
         TabIndex        =   11
         Top             =   1440
         Width           =   975
      End
      Begin VB.Label lblPart2 
         Caption         =   "Part 2"
         Height          =   255
         Index           =   1
         Left            =   1080
         TabIndex        =   15
         Top             =   1920
         Width           =   975
      End
      Begin VB.Label lblPart1 
         Caption         =   "Part 1"
         Height          =   255
         Index           =   1
         Left            =   1080
         TabIndex        =   12
         Top             =   1440
         Width           =   975
      End
      Begin VB.Label lblAnswer 
         Caption         =   "Answer"
         Height          =   255
         Left            =   3600
         TabIndex        =   3
         Top             =   0
         Width           =   975
      End
      Begin VB.Label lblTest 
         Caption         =   "Test"
         Height          =   255
         Left            =   2280
         TabIndex        =   2
         Top             =   0
         Width           =   975
      End
      Begin VB.Label lblPart2 
         Caption         =   "Part 2"
         Height          =   255
         Index           =   0
         Left            =   1080
         TabIndex        =   8
         Top             =   840
         Width           =   975
      End
      Begin VB.Label lblPart1 
         Caption         =   "Part 1"
         Height          =   255
         Index           =   0
         Left            =   1080
         TabIndex        =   5
         Top             =   360
         Width           =   975
      End
      Begin VB.Label lblDay 
         Caption         =   "Day 1"
         Height          =   255
         Index           =   0
         Left            =   0
         TabIndex        =   4
         Top             =   360
         Width           =   975
      End
   End
   Begin MSComctlLib.TabStrip TabStrip1 
      Height          =   4695
      Left            =   120
      TabIndex        =   0
      Top             =   120
      Width           =   7575
      _ExtentX        =   13361
      _ExtentY        =   8281
      _Version        =   393216
      BeginProperty Tabs {1EFB6598-857C-11D1-B16A-00C0F0283628} 
         NumTabs         =   1
         BeginProperty Tab1 {1EFB659A-857C-11D1-B16A-00C0F0283628} 
            Caption         =   "Days 1-5"
            ImageVarType    =   2
         EndProperty
      EndProperty
   End
End
Attribute VB_Name = "frmAdventOfCode2022"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Sub Form_Load()
    Call ExecuteDay01
End Sub

Private Sub ExecuteDay01()
    Dim Day As New AdventOfCode2022.clsDay01
    Dim strTestFileContents() As String
    Dim strAnswerFileContents() As String
    Dim strDay1Part1Test As String
    Dim strDay1Part2Test As String
    strTestFileContents = basUtils.ReadFile("Day01_test")
    strAnswerFileContents = basUtils.ReadFile("Day01")
    strDay1Part1Test = Day.ExecutePartOne(strTestFileContents)
    txtPart1Test(0).Text = IIf(strDay1Part1Test = 24000, "Passed", "Failed, got " + strDay1Part1Test)
    txtPart1Answer(0).Text = Day.ExecutePartOne(strAnswerFileContents) '69281
    strDay1Part2Test = Day.ExecutePartTwo(strTestFileContents)
    txtPart2Test(0).Text = IIf(strDay1Part2Test = 45000, "Passed", "Failed, got " + strDay1Part2Test)
    txtPart2Answer(0).Text = Day.ExecutePartTwo(strAnswerFileContents) '201524
End Sub
