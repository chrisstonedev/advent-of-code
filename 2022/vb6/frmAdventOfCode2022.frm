VERSION 5.00
Begin VB.Form frmAdventOfCode2022 
   Caption         =   "Form1"
   ClientHeight    =   4980
   ClientLeft      =   120
   ClientTop       =   465
   ClientWidth     =   7845
   LinkTopic       =   "Form1"
   ScaleHeight     =   4980
   ScaleWidth      =   7845
   StartUpPosition =   3  'Windows Default
   Begin VB.TextBox txtDay1Part1Test 
      Enabled         =   0   'False
      Height          =   375
      Left            =   1320
      Locked          =   -1  'True
      TabIndex        =   3
      Text            =   "Text1"
      Top             =   480
      Width           =   2775
   End
   Begin VB.TextBox txtDay1Part2Test 
      Enabled         =   0   'False
      Height          =   375
      Left            =   1320
      Locked          =   -1  'True
      TabIndex        =   2
      Text            =   "Text1"
      Top             =   1440
      Width           =   2775
   End
   Begin VB.TextBox txtDay1Part2Answer 
      Height          =   375
      Left            =   1320
      Locked          =   -1  'True
      TabIndex        =   1
      Text            =   "Text1"
      Top             =   1920
      Width           =   2775
   End
   Begin VB.TextBox txtDay1Part1Answer 
      Height          =   375
      Left            =   1320
      Locked          =   -1  'True
      TabIndex        =   0
      Text            =   "Text1"
      Top             =   960
      Width           =   2775
   End
   Begin VB.Label lblDay1Part2 
      Caption         =   "Part 2"
      Height          =   255
      Left            =   240
      TabIndex        =   6
      Top             =   1920
      Width           =   975
   End
   Begin VB.Label lblDay1Part1 
      Caption         =   "Part 1"
      Height          =   255
      Left            =   240
      TabIndex        =   5
      Top             =   960
      Width           =   975
   End
   Begin VB.Label lblDay1 
      Caption         =   "Day 1"
      Height          =   255
      Left            =   240
      TabIndex        =   4
      Top             =   120
      Width           =   975
   End
End
Attribute VB_Name = "frmAdventOfCode2022"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False
Private Sub Form_Load()
    Call ExecuteDay1
End Sub

Private Sub ExecuteDay1()
    Dim Day As New AdventOfCode2022.clsDay01
    Dim strTestFileContents() As String
    Dim strAnswerFileContents() As String
    Dim strDay1Part1Test As String
    Dim strDay1Part2Test As String
    strTestFileContents = basUtils.ReadFile("Day01_test")
    strAnswerFileContents = basUtils.ReadFile("Day01")
    strDay1Part1Test = Day.ExecutePartOne(strTestFileContents)
    txtDay1Part1Test.Text = IIf(strDay1Part1Test = 24000, "Passed", "Failed, got " + strDay1Part1Test)
    txtDay1Part1Answer.Text = Day.ExecutePartOne(strAnswerFileContents) '69281
    strDay1Part2Test = Day.ExecutePartTwo(strTestFileContents)
    txtDay1Part2Test.Text = IIf(strDay1Part2Test = 45000, "Passed", "Failed, got " + strDay1Part2Test)
    txtDay1Part2Answer.Text = Day.ExecutePartTwo(strAnswerFileContents) '201524
End Sub

